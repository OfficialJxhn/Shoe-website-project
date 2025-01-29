import requests # needed to use the nike api
import json # needed so i can read the json file sent from the api
import mysql.connector # needed so i can connect to the mysql database
import sql_stock_queries_jordan # needed so i can access the functions from the file

# Database configuration
db_config = {
    "host": "localhost",
    "user": "root",
    "password": "",
    "database": "myfirstdatabase",
}

# Establish a connection to the database
connection = mysql.connector.connect(**db_config)
cursor = connection.cursor()

url = f"https://api.nike.com/cic/browse/v2?queryid=products&anonymousId=F9238B93FDB06EC479FBD6B80905A625&country=us&endpoint=%2Fproduct_feed%2Frollup_threads%2Fv2%3Ffilter%3Dmarketplace(US)%26filter%3Dlanguage(en)%26filter%3DemployeePrice(true)%26filter%3DattributeIds(0d17e0df-9083-4e44-b263-71c2565d4783)%26anchor%3D24%26consumerChannelId%3Dd9a5bc42-4b9c-4976-858a-f159cf99c647%26count%3D24&language=en&localizedRangeStr=%7BlowestPrice%7D%20%E2%80%94%20%7BhighestPrice%7D"

html = requests.get(url=url)
output = json.loads(html.text)


for item in output["data"]["products"]["products"]:
    for item in output["data"]["products"]["products"]:
        name_of_shoe = item["title"]
        if item["productType"] == "FOOTWEAR" and ("jordan" in name_of_shoe.lower()) == True:
            item_url= item["url"]
            item_url = str(item_url).replace("{countryLang}", "nike.com")
            
            
            sql_stock_queries_jordan.search_for_dupes(item["id"],item["inStock"])
            
            sql_stock_queries_jordan.insert_into_shoe_table(item,item_url)

connection.close()