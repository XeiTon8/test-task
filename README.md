# Shipping Calculator
This is a small shipping calculator app. It allows users to calculate shipping costs for different carriers based on parcel weight.  

**Stack:**
- Backend: PHP 8.4 + Symfony 6 + nginx  
- Frontend: React + Vite  
- Orchestrated with Docker  

**Features:**
- Calculate shipping price for a selected carrier
- Extensible architecture for adding new carriers
- Includes unit and API tests

## Installation

Clone the repository, then run:
cd test-task
docker compose up --build

To open frontend on your browser:
http://localhost:5173

The backend runs at:
http://localhost:8000

## Architecture overview
The app uses the **Strategy Pattern**. Each carrier has its own class with its own pricing rules.  
The `Calculator` service uses the `CarrierRegistry` to find the correct carrier and calculate the price.  

### Components
- **Calculator** Calculates price for a given carrier and weight.
- **Carrier Registry** Holds all carriers and returns the one we need.
- **Carriers** Concrete classes like `TransCompany` and `PackGroup` with their own pricing.
- **ShippingController** Receives API requests and returns price in JSON.
- **Frontend** React app with a simple form.
