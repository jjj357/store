
# when using the ORM - load seed data into database from json files.
php bin/console doctrine:fixtures:load

=================Use Fiddler to test REST Web Services:====================

GET /api/categories HTTP/1.1

Host: localhost/api/categories

=====================
GET /api/products HTTP/1.1

Host: localhost/api/products


===================
GET /api/product/3 HTTP/1.1

Host: localhost/api/product/3


===================
POST /api/products HTTP/1.1

Host: localhost/api/products

Content-Type: application/json

{"name": "Dog","category": "Arts","sku": "A0008","price": 89.99,"quantity": 88}

===================
PUT /api/product HTTP/1.1

Host: http://localhost/api/product/3

Content-Type: application/json

{"name": "NewPainting"}

=======================
DELETE /api/product/3 HTTP/1.1

Host: http://localhost/api/product/3
