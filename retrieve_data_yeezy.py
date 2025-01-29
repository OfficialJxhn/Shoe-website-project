import requests
import json
import mysql.connector # needed so i can connect to the mysql database
import sql_stock_queries_yeezy # needed so i can access the functions from the file

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

url = "https://sneakers-real-time-pricing.p.rapidapi.com/sneakers"

querystring = {"name":"Yeezy",
               "extended":"true"}

headers = {
	"X-RapidAPI-Key": "25df35a0f2mshdfc47dc935f451ap1c7cffjsn351c448a643d",
	"X-RapidAPI-Host": "sneakers-real-time-pricing.p.rapidapi.com"
}

response = requests.get(url, headers=headers, params=querystring)
output = json.loads(response.text)

for item in output["data"]:
	name_of_item = (item["name"]).replace(" ","%20")
	url_for_shoe = f"https://www.goat.com/en-gb/search?query={name_of_item}"
	data = requests.get(url_for_shoe)
	print(url_for_shoe)

	if ('class="SearchNoResults__Wrapper-sc-j024wp-0 eSXYik"' in data.text):
		stock = False
	else:
		stock = True

	#this will then go to the query files to then connect to the database and carry out the queries
	#i decided to do it this way as it cleans up the code and makes it more managable
	sql_stock_queries_yeezy.search_for_dupes(item["id"],stock)

	sql_stock_queries_yeezy.insert_into_shoe_table(item,url_for_shoe)

connection.close()