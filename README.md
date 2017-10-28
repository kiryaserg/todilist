todolist
========

A Symfony project created on October 28, 2017, 9:49 am.

1. Install an application via composer:  
`
composer install
`
2. Generate the SSH keys :
`
openssl genrsa -out var/jwt/private.pem -aes256 4096
openssl rsa -pubout -in var/jwt/private.pem -out var/jwt/public.pem
`

