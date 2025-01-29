import mysql.connector

db_config = {
    "host": "localhost",
    "user": "root",
    "password": "",
    "database": "myfirstdatabase",
}

connection = mysql.connector.connect(**db_config)
cursor = connection.cursor()

def search_for_dupes(id,stock):
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
    try:
        check_for_dupes_query = "SELECT * FROM stock_table WHERE id_for_shoes = %s"
        id_for_shoe = id
        insert = (id_for_shoe,)
        cursor.execute(check_for_dupes_query,insert)
        results = cursor.fetchall()
        cursor.close()
        
        match results:
            case []:
                insert_into_stock_table(id,stock)
            case _:
                update_stock_table(id,stock)
                
    except mysql.connector.Error as err:
        print(f"Error: {err}")

def update_stock_table(id,stock):
    db_config = {
        "host": "localhost",
        "user": "root",
        "password": "",
        "database": "myfirstdatabase",
    }

    # Establish a connection to the database
    connection = mysql.connector.connect(**db_config)
    cursor = connection.cursor()
    try:
        update_query_shoes = "UPDATE stock_table SET instock = %s WHERE id_for_shoes = %s"
        params = (stock,id)
        cursor.execute(update_query_shoes,params)
        connection.commit()
    except mysql.connector.Error as err:
        print("error", err)

def insert_into_shoe_table(item,url):
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
    try:
        item_url= item["url"]
        item_url = str(item_url).replace("{countryLang}", "nike.com")
        insert_query_shoes = "INSERT INTO shoes (ShoeID, shoeName, price, image_url, brand, url_table) VALUES (%s, %s, %s, %s, %s, %s)"
        insert = (item["id"],item["title"], item["price"]["currentPrice"], item["images"]["portraitURL"], "jordan", url)
                    
        cursor.execute(insert_query_shoes, insert)
        connection.commit()
                
    except mysql.connector.Error as err:
            print("error ",err)
            
def insert_into_stock_table(id_for_shoes,stock):
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
        
    insert_query_stock = "INSERT INTO stock_table (id_for_shoes, instock) VALUES (%s, %s)"
    insert = (id_for_shoes,stock)
    
    cursor.execute(insert_query_stock,insert)
    
    
    #new_cursor.execute(insert_query_stock,insert)
    connection.commit()
    