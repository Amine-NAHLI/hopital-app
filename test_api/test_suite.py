import requests
import json
import time

# Configuration (Seule l'URL est statique, car c'est le point d'entrée)
BASE_URL = "http://127.0.0.1:8000/api"

class ApiTester:
    def __init__(self):
        self.token = None
        self.user_data = None
        self.headers = {
            "Accept": "application/json",
            "Content-Type": "application/json"
        }
        self.results = []

    def log(self, message, success=True):
        status = "✅ SUCCESS" if success else "❌ FAILED"
        print(f"[{status}] {message}")
        self.results.append({"test": message, "success": success})

    def fetch_dynamic_user(self):
        """Récupère dynamiquement un utilisateur admin depuis la base de données via l'API"""
        print("--- Fetching Dynamic User Data ---")
        try:
            response = requests.get(f"{BASE_URL}/demo-users", headers=self.headers)
            if response.status_code == 200:
                users = response.json().get("data", [])
                # On cherche le premier admin pour les tests
                admin = next((u for u in users if u['role'] == 'admin'), None)
                if admin:
                    self.user_data = admin
                    self.log(f"Found dynamic admin: {admin['name']} (ID: {admin['id']})")
                    return True
                else:
                    self.log("No admin user found in demo-users list", False)
            else:
                self.log(f"Failed to fetch demo users: {response.status_code}", False)
        except Exception as e:
            self.log(f"Error fetching dynamic users: {str(e)}", False)
        return False

    def login(self):
        """Se connecte sans mot de passe en utilisant le magic_id (ID récupéré en base)"""
        if not self.user_data:
            return False
            
        print(f"--- Authenticating (Magic Login for ID {self.user_data['id']}) ---")
        try:
            # On n'envoie PAS de mot de passe, juste l'ID récupéré dynamiquement
            payload = {"magic_id": self.user_data['id']}
            response = requests.post(f"{BASE_URL}/login", json=payload, headers=self.headers)
            
            if response.status_code == 200:
                data = response.json()
                self.token = data.get("token")
                self.headers["Authorization"] = f"Bearer {self.token}"
                self.log(f"Dynamic Login successful. Welcome {data['user']['name']}")
                return True
            else:
                self.log(f"Login failed: {response.text}", False)
                return False
        except Exception as e:
            self.log(f"Login error: {str(e)}", False)
            return False

    def test_endpoint(self, name, endpoint, method="GET", params=None):
        print(f"--- Testing {name} ({endpoint}) ---")
        try:
            if method == "GET":
                response = requests.get(f"{BASE_URL}{endpoint}", headers=self.headers, params=params)
            else:
                response = requests.post(f"{BASE_URL}{endpoint}", headers=self.headers, json=params)
            
            if response.status_code == 200:
                data = response.json()
                if data.get("success"):
                    self.log(f"{name} retrieved successfully")
                    return True
                else:
                    self.log(f"{name} API returned success=False", False)
            else:
                self.log(f"{name} HTTP Error {response.status_code}", False)
        except Exception as e:
            self.log(f"Error testing {name}: {str(e)}", False)
        return False

    def run_suite(self):
        print("🚀 Starting DYNAMIC MediCore Nova API Test Suite")
        print("   (No hardcoded credentials - Everything is fetched from DB)\n")
        
        # 1. On récupère un utilisateur dynamiquement
        if not self.fetch_dynamic_user():
            print("\n🚨 Aborting tests: Could not find dynamic user.")
            return

        # 2. On se connecte via magic_id
        if not self.login():
            print("\n🚨 Aborting tests: Dynamic authentication failed.")
            return

        # 3. On teste les endpoints
        self.test_endpoint("User Profile", "/user")
        self.test_endpoint("Global Stats", "/stats")
        self.test_endpoint("Patients List", "/patients")
        self.test_endpoint("Medecins List", "/medecins")
        self.test_endpoint("Rendez-vous List", "/rendez-vous")
        
        # Test Patient Detail (dynamique aussi)
        resp = requests.get(f"{BASE_URL}/patients", headers=self.headers)
        if resp.status_code == 200:
            patients = resp.json().get("data", {}).get("data", [])
            if patients:
                pid = patients[0]['id']
                self.test_endpoint(f"Patient Detail (ID: {pid})", f"/patients/{pid}")

        # 4. Déconnexion
        self.test_endpoint("Logout", "/logout", method="POST")

        print("\n--- Final Summary ---")
        success_count = sum(1 for r in self.results if r['success'])
        print(f"Passed: {success_count}/{len(self.results)}")
        if success_count == len(self.results):
            print("\n✨ ALL DYNAMIC TESTS PASSED! API IS PERFECT. ✨")
        else:
            print("\n⚠️ SOME TESTS FAILED. CHECK LOGS ABOVE. ⚠️")

if __name__ == "__main__":
    tester = ApiTester()
    tester.run_suite()
