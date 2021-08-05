import requests

url = 'https://hookb.in/xxxxxxxxxxxxxx'

data = {
    "name": "John"
}

r = requests.post(url, verify=False, json=data)
