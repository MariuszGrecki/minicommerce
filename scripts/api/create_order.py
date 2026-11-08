import json
import urllib.request

payload = {
    "customer_id": 15,
    "total_amount": "-199.99",
}

url = "http://127.0.0.1:33377/api/orders"

json_text = json.dumps(payload)
body = json_text.encode("utf-8")

request = urllib.request.Request(
    url,
    data=body,
    headers={
        "Content-Type": "application/json",
        "Accept": "application/json",
    },
    method="POST",
)

try:
    with urllib.request.urlopen(request, timeout=5) as response:
        print("HTTP:", response.status)
        print(response.read().decode("utf-8"))

except urllib.error.HTTPError as error:
    print("Błąd HTTP", error.code)
    text = error.read().decode("utf-8")
    data = json.loads(text)

    print(data['message'])


