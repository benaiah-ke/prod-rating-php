from textblob import TextBlob
import mysql.connector
import json
import requests
import sys

# Function to get the sentiment of a comment and return a ratings
def get_sentiment_ratings(comment):
    analysis = TextBlob(comment)
    # if analysis.sentiment.polarity > 0:
    #     return 'positive'
    # elif analysis.sentiment.polarity == 0:
    #     return 'neutral'
    # else:
    #     return 'negative'
    return analysis.sentiment.polarity

#create a database connection
def create_connection():
    conn = None
    try:
        conn = mysql.connector.connect(
            host="localhost",
            user="root",
            password="",
            database="prod-rating"
        )
        # print("successful connection with MySQL")
    except mysql.connector.Error as e:
        print(e)
    
    if conn:
        return conn

connection = create_connection()

# #pick the comment details fom php
# name = sys.argv[1]
# comment = sys.argv[2]
# product_id = sys.argv[3]

# Fetch the comment details from the database
# def fetch_comment(conn,id):
#     cursor =  conn.cursor()
#     sqlf = ("SELECT * FROM `comments` WHERE id = %d"%id)
#     cursor.execute(sqlf)
#     result = cursor.fetchone()
#     return result

# id = int(sys.argv[1])
# comment = fetch_comment(connection,id)

#get the comment from php
comment = sys.argv[1]
product_id = int(sys.argv[2])

#analyse the comment polarity and generate a rating
rating = get_sentiment_ratings(comment)

#Normalize score to a range of 0 to 5
rating = round((((rating + 1)/2) * 5),1)


# #save the comment and the rating
# comment = (name,comment,rating,product_id)

# sql = ("INSERT INTO `comments` (`name`, `comment`, `ratings`, `product_id`) VALUES (%s, %s, %s, %s)")
# cursor.execute(sql,comment)

# # Update the database with the rating
# def update_comment_rating(conn,id,rating):
#     cursor = conn.cursor()
#     sqlf = ("UPDATE `comments` SET `ratings` = '%s' WHERE id = '%d'"%(rating, id))
#     cursor.execute(sqlf)
#     conn.commit()

print(rating)
rating
# update_comment_rating(connection,id,rating)

# connection.commit()
# connection.close()

# Function to send the comment, ratings and product id to the PHP script
# def send_data_to_php(ratings, product_id):
#     # data = {'comment': comment, 'ratings': ratings, 'product_id': product_id}
#     response = requests.post('http://localhost/prod-rating-php/product.php?id=%s'%product_id, json.dumps(ratings))
#     print (response.text)
#     return response.text
#     # print (data)

# # send_data_to_php(rating,product_id)

# # def return_comment_data (comment):
# #     rating = get_sentiment_ratings(comment)
# #     print (rating)

# def this_works():
#         print("This works and here is proof")
#         return "this works"

# if __name__ == '__main__':
#     # get_sentiment_ratings(sys.argv[1])
#     this_works()
    