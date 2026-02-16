import { useState } from "react";

type Response = {
  carrier: string;
  weightKG: number;
  currency: string;
  price: number;
};

function App() {
  const [weight, setWeight] = useState<number>(0);
  const [carrier, setCarrier] = useState<string>("transcompany");
  const [result, setResult] = useState<Response | null>(null);
  const [error, setError] = useState<string | null>(null);
  const [loading, setLoading] = useState(false);

  const carriers = [
    { id: "transcompany", label: "Trans Company" },
    { id: "packgroup", label: "Pack Group" },
    { id: "unknown", label: "Some other carrier" }
  ];

  const handleSubmit = async (e: React.SubmitEvent) => {
    e.preventDefault();

    setError(null);
    setResult(null);

    if (weight <= 0) {
      setError("Weight must be greater than 0");
      return;
    }

    try {
      setLoading(true);
      const res = await fetch(
        "http://localhost:8000/api/shipping/calculate",
        {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify({
            carrier,
            weightKG: weight,
          }),
        }
      );

      const data = await res.json();

      if (!res.ok) {
        throw new Error(data.error || "Something went wrong");
      }

      setResult(data);
      
    } catch (err: any) {
      setError(err.message);
    } finally {
      setLoading(false);
    }
  };

  return (
    <div style={{ 
    width: "100%", 
    margin: "30px auto", 
    fontFamily: "Arial", 
    backgroundColor: "#514f4f", 
    padding: "14px", 
    borderRadius: "10px",
    textAlign: "center" }}>

      <h2>Shipping Price Calculator</h2>

      <form onSubmit={handleSubmit} style={{display: "flex", flexDirection: "column", alignItems: "center"}}>
       
        <div style={{ marginBottom: 12, display: "flex", flexDirection: "column", alignItems: "center", gap: "5px" }}>
          <label>Weight (kg)</label>
          <input
            type="number"
            value={weight}
            onChange={(e) => setWeight(Number(e.target.value))}
            min="0"
            inputMode="decimal"
            step="any"
            required
          />
        </div>

        <div style={{ marginBottom: 12, display: "flex", flexDirection: "column", alignItems: "center", gap: "5px" }}>
         
         <label>Carrier</label>
          <select
            value={carrier}
            onChange={(e) => setCarrier(e.target.value)}
          >
            {carriers.map((carrier) => (
              <option key={carrier.id} value={carrier.id}>
                {carrier.label}
              </option>
            ))}
          </select>

        </div>

        <button type="submit" disabled={loading}>
          {loading ? "Calculating..." : "Calculate price"}
        </button>
      </form>

      {error && (
        <div style={{ marginTop: 20, color: "red", display: "block" }}>
          <span>Error:</span> {error}
        </div>
      )}

      {result && (
        <div style={{ marginTop: 20, color: "green", display: "block", fontWeight: "800", fontSize: "18px" }}>
          <span>Price:</span> {result.price} {result.currency}
        </div>
      )}
    </div>
  );
}

export default App;
