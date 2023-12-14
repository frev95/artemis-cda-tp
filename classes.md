# Classes

#Book
- id (int)
- title (string)
- description (string)
- ISBN (string)
- author_id (int)
- publisher_id (int)

#Author
- id (int)
- name (string)
- bio (text)

#Publisher
- id (int)
- name (string)

#Client
- id (int)
- name (string)
- email (string)
- deposit (int)

#Loan
- id (int)
- client_id (int)
- book_id (int)
- start_date (date)
- end_date (date)
- returned (boolean)

