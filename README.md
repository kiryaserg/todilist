todolist
========

1. Install an application via composer:  

`
composer install
`
2. Generate the SSH keys :

`
mkdir var/jwt
`

`
openssl genrsa -out var/jwt/private.pem -aes256 4096
`

`
openssl rsa -pubout -in var/jwt/private.pem -out var/jwt/public.pem
`
3. Run database migrations

`
php bin/console doctrine:migrations:migrate 
` 
4. Run server

`
php bin/console server:run
` 
5. To get token need to authenticate as a test user need to send POST request with _username=test and _password=test to the api/login_check
 
`
curl -X POST http://127.0.0.1:8000/api/login_check -d _username=test -d _password=test
` 

You will receive something like this:
 
`
{
   "token" : "eyJhbGciOiJSUzI1NiJ9.eyJyb2xlcyI6WyJST0xFX1VTRVIiXSwidXNlcm5hbWUiOiJ0ZXN0IiwiaWF0IjoxNTA5NTc0MzQwLCJleHAiOjE1NDExMTAzNDB9.aZL4GaTLiVlSoB1NOkDaWnpfSGS6abOq-yaeCzjmnjPWJwsREuYq-lArWq1CHpg7P-kBlAYJQI4VLdFgvzGY8IS3xG2Uf7FdDahQvFS1g_o9Z2eh3znu_PDik06WBo5gyezVCSGsplFOCS0RarVTR5JrM1PZ_0HNnv_U_6pT-EIMYZgktwZNQcPEZ4vxGsR45ezXGbvwnHzU-x3zDR6Fv0L90Gcxi53MMybcO_4uQJOQCPUYO04YmFfGOzdZrz5RH92sL1rK5g6Hw4E0Pu0RSMkT6f8PqgsmXJ44pUuj9tAXk1VUMEnyz1772aVPxc5r2Ion54pq0PUZyiR52WJS68-2TLKFFibALnos7ZIhT-EGWS-TGvoK1wNK5z7SM8ACK_EqJLuPuVTiThN96ymFSw_SiU7dP7xXdPHQ_8Nea3nAts8mgyEk-TAib2nYGRReiGGET6MVxZREIYlQ9FAbigVWin-Nvee4Eci49sV5O8vIPaYliEEuuV4ue3X59TfgAoLMZ2iNyUafHkRBGJ0iAdRPMqWLhj4GXG9FnIl-iuV-9bUAvFm7TrNn76dufGmWSkr5Zl7kmU42gLoTofhDN-v9paCTHZFTccc3Sojdv_Ynx3UbFdiX4T4f7w4zDgJbq60uYcMgAydNqfUftV3L_DOU_gOwudkH4S5vacKCJPc"
}
`
 
6. To create a new task send POST request to te path api/task it requires field name
 
`
curl -X POST http://127.0.0.1:8000/api/task -d name=testname -H "Authorization: Bearer eyJhbGciOiJSUzI1NiJ9.eyJyb2xlcyI6WyJST0xFX1VTRVIiXSwidXNlcm5hbWUiOiJ0ZXN0IiwiaWF0IjoxNTA5NTc0MzQwLCJleHAiOjE1NDExMTAzNDB9.aZL4GaTLiVlSoB1NOkDaWnpfSGS6abOq-yaeCzjmnjPWJwsREuYq-lArWq1CHpg7P-kBlAYJQI4VLdFgvzGY8IS3xG2Uf7FdDahQvFS1g_o9Z2eh3znu_PDik06WBo5gyezVCSGsplFOCS0RarVTR5JrM1PZ_0HNnv_U_6pT-EIMYZgktwZNQcPEZ4vxGsR45ezXGbvwnHzU-x3zDR6Fv0L90Gcxi53MMybcO_4uQJOQCPUYO04YmFfGOzdZrz5RH92sL1rK5g6Hw4E0Pu0RSMkT6f8PqgsmXJ44pUuj9tAXk1VUMEnyz1772aVPxc5r2Ion54pq0PUZyiR52WJS68-2TLKFFibALnos7ZIhT-EGWS-TGvoK1wNK5z7SM8ACK_EqJLuPuVTiThN96ymFSw_SiU7dP7xXdPHQ_8Nea3nAts8mgyEk-TAib2nYGRReiGGET6MVxZREIYlQ9FAbigVWin-Nvee4Eci49sV5O8vIPaYliEEuuV4ue3X59TfgAoLMZ2iNyUafHkRBGJ0iAdRPMqWLhj4GXG9FnIl-iuV-9bUAvFm7TrNn76dufGmWSkr5Zl7kmU42gLoTofhDN-v9paCTHZFTccc3Sojdv_Ynx3UbFdiX4T4f7w4zDgJbq60uYcMgAydNqfUftV3L_DOU_gOwudkH4S5vacKCJPc"
`
7. To check a list of objects use GET method
 
`
curl -X GET http://127.0.0.1:8000/api/task -d name=testname -H "Authorization: Bearer eyJhbGciOiJSUzI1NiJ9.eyJyb2xlcyI6WyJST0xFX1VTRVIiXSwidXNlcm5hbWUiOiJ0ZXN0IiwiaWF0IjoxNTA5NTc0MzQwLCJleHAiOjE1NDExMTAzNDB9.aZL4GaTLiVlSoB1NOkDaWnpfSGS6abOq-yaeCzjmnjPWJwsREuYq-lArWq1CHpg7P-kBlAYJQI4VLdFgvzGY8IS3xG2Uf7FdDahQvFS1g_o9Z2eh3znu_PDik06WBo5gyezVCSGsplFOCS0RarVTR5JrM1PZ_0HNnv_U_6pT-EIMYZgktwZNQcPEZ4vxGsR45ezXGbvwnHzU-x3zDR6Fv0L90Gcxi53MMybcO_4uQJOQCPUYO04YmFfGOzdZrz5RH92sL1rK5g6Hw4E0Pu0RSMkT6f8PqgsmXJ44pUuj9tAXk1VUMEnyz1772aVPxc5r2Ion54pq0PUZyiR52WJS68-2TLKFFibALnos7ZIhT-EGWS-TGvoK1wNK5z7SM8ACK_EqJLuPuVTiThN96ymFSw_SiU7dP7xXdPHQ_8Nea3nAts8mgyEk-TAib2nYGRReiGGET6MVxZREIYlQ9FAbigVWin-Nvee4Eci49sV5O8vIPaYliEEuuV4ue3X59TfgAoLMZ2iNyUafHkRBGJ0iAdRPMqWLhj4GXG9FnIl-iuV-9bUAvFm7TrNn76dufGmWSkr5Zl7kmU42gLoTofhDN-v9paCTHZFTccc3Sojdv_Ynx3UbFdiX4T4f7w4zDgJbq60uYcMgAydNqfUftV3L_DOU_gOwudkH4S5vacKCJPc"
`
8. To change name use PUT method and set Id to path api/task/{id}
 
`
curl -X PUT http://127.0.0.1:8000/api/task/9e257e37-be83-11e7-bb76-b888e33a4cdb -d name=testname2 -H "Authorization: Bearer eyJhbGciOiJSUzI1NiJ9.eyJyb2xlcyI6WyJST0xFX1VTRVIiXSwidXNlcm5hbWUiOiJ0ZXN0IiwiaWF0IjoxNTA5NTc0MzQwLCJleHAiOjE1NDExMTAzNDB9.aZL4GaTLiVlSoB1NOkDaWnpfSGS6abOq-yaeCzjmnjPWJwsREuYq-lArWq1CHpg7P-kBlAYJQI4VLdFgvzGY8IS3xG2Uf7FdDahQvFS1g_o9Z2eh3znu_PDik06WBo5gyezVCSGsplFOCS0RarVTR5JrM1PZ_0HNnv_U_6pT-EIMYZgktwZNQcPEZ4vxGsR45ezXGbvwnHzU-x3zDR6Fv0L90Gcxi53MMybcO_4uQJOQCPUYO04YmFfGOzdZrz5RH92sL1rK5g6Hw4E0Pu0RSMkT6f8PqgsmXJ44pUuj9tAXk1VUMEnyz1772aVPxc5r2Ion54pq0PUZyiR52WJS68-2TLKFFibALnos7ZIhT-EGWS-TGvoK1wNK5z7SM8ACK_EqJLuPuVTiThN96ymFSw_SiU7dP7xXdPHQ_8Nea3nAts8mgyEk-TAib2nYGRReiGGET6MVxZREIYlQ9FAbigVWin-Nvee4Eci49sV5O8vIPaYliEEuuV4ue3X59TfgAoLMZ2iNyUafHkRBGJ0iAdRPMqWLhj4GXG9FnIl-iuV-9bUAvFm7TrNn76dufGmWSkr5Zl7kmU42gLoTofhDN-v9paCTHZFTccc3Sojdv_Ynx3UbFdiX4T4f7w4zDgJbq60uYcMgAydNqfUftV3L_DOU_gOwudkH4S5vacKCJPc"
`
9. To set is read flag use PUT method and set Id to path api/task/{id}
 
`
curl -X PUT http://127.0.0.1:8000/api/task/9e257e37-be83-11e7-bb76-b888e33a4cdb -d isread=1 -H "Authorization: Bearer eyJhbGciOiJSUzI1NiJ9.eyJyb2xlcyI6WyJST0xFX1VTRVIiXSwidXNlcm5hbWUiOiJ0ZXN0IiwiaWF0IjoxNTA5NTc0MzQwLCJleHAiOjE1NDExMTAzNDB9.aZL4GaTLiVlSoB1NOkDaWnpfSGS6abOq-yaeCzjmnjPWJwsREuYq-lArWq1CHpg7P-kBlAYJQI4VLdFgvzGY8IS3xG2Uf7FdDahQvFS1g_o9Z2eh3znu_PDik06WBo5gyezVCSGsplFOCS0RarVTR5JrM1PZ_0HNnv_U_6pT-EIMYZgktwZNQcPEZ4vxGsR45ezXGbvwnHzU-x3zDR6Fv0L90Gcxi53MMybcO_4uQJOQCPUYO04YmFfGOzdZrz5RH92sL1rK5g6Hw4E0Pu0RSMkT6f8PqgsmXJ44pUuj9tAXk1VUMEnyz1772aVPxc5r2Ion54pq0PUZyiR52WJS68-2TLKFFibALnos7ZIhT-EGWS-TGvoK1wNK5z7SM8ACK_EqJLuPuVTiThN96ymFSw_SiU7dP7xXdPHQ_8Nea3nAts8mgyEk-TAib2nYGRReiGGET6MVxZREIYlQ9FAbigVWin-Nvee4Eci49sV5O8vIPaYliEEuuV4ue3X59TfgAoLMZ2iNyUafHkRBGJ0iAdRPMqWLhj4GXG9FnIl-iuV-9bUAvFm7TrNn76dufGmWSkr5Zl7kmU42gLoTofhDN-v9paCTHZFTccc3Sojdv_Ynx3UbFdiX4T4f7w4zDgJbq60uYcMgAydNqfUftV3L_DOU_gOwudkH4S5vacKCJPc"
`
10. To see concrete task use GET method and set Id to path api/task/{id}

`
curl -X GET http://127.0.0.1:8000/api/task/9e257e37-be83-11e7-bb76-b888e33a4cdb -H "Authorization: Bearer eyJhbGciOiJSUzI1NiJ9.eyJyb2xlcyI6WyJST0xFX1VTRVIiXSwidXNlcm5hbWUiOiJ0ZXN0IiwiaWF0IjoxNTA5NTc0MzQwLCJleHAiOjE1NDExMTAzNDB9.aZL4GaTLiVlSoB1NOkDaWnpfSGS6abOq-yaeCzjmnjPWJwsREuYq-lArWq1CHpg7P-kBlAYJQI4VLdFgvzGY8IS3xG2Uf7FdDahQvFS1g_o9Z2eh3znu_PDik06WBo5gyezVCSGsplFOCS0RarVTR5JrM1PZ_0HNnv_U_6pT-EIMYZgktwZNQcPEZ4vxGsR45ezXGbvwnHzU-x3zDR6Fv0L90Gcxi53MMybcO_4uQJOQCPUYO04YmFfGOzdZrz5RH92sL1rK5g6Hw4E0Pu0RSMkT6f8PqgsmXJ44pUuj9tAXk1VUMEnyz1772aVPxc5r2Ion54pq0PUZyiR52WJS68-2TLKFFibALnos7ZIhT-EGWS-TGvoK1wNK5z7SM8ACK_EqJLuPuVTiThN96ymFSw_SiU7dP7xXdPHQ_8Nea3nAts8mgyEk-TAib2nYGRReiGGET6MVxZREIYlQ9FAbigVWin-Nvee4Eci49sV5O8vIPaYliEEuuV4ue3X59TfgAoLMZ2iNyUafHkRBGJ0iAdRPMqWLhj4GXG9FnIl-iuV-9bUAvFm7TrNn76dufGmWSkr5Zl7kmU42gLoTofhDN-v9paCTHZFTccc3Sojdv_Ynx3UbFdiX4T4f7w4zDgJbq60uYcMgAydNqfUftV3L_DOU_gOwudkH4S5vacKCJPc"
`
11. To delete use DELETE method and set Id to path api/task/{id}

`
curl -X DELETE http://127.0.0.1:8000/api/task/9e257e37-be83-11e7-bb76-b888e33a4cdb -H "Authorization: Bearer eyJhbGciOiJSUzI1NiJ9.eyJyb2xlcyI6WyJST0xFX1VTRVIiXSwidXNlcm5hbWUiOiJ0ZXN0IiwiaWF0IjoxNTA5NTc0MzQwLCJleHAiOjE1NDExMTAzNDB9.aZL4GaTLiVlSoB1NOkDaWnpfSGS6abOq-yaeCzjmnjPWJwsREuYq-lArWq1CHpg7P-kBlAYJQI4VLdFgvzGY8IS3xG2Uf7FdDahQvFS1g_o9Z2eh3znu_PDik06WBo5gyezVCSGsplFOCS0RarVTR5JrM1PZ_0HNnv_U_6pT-EIMYZgktwZNQcPEZ4vxGsR45ezXGbvwnHzU-x3zDR6Fv0L90Gcxi53MMybcO_4uQJOQCPUYO04YmFfGOzdZrz5RH92sL1rK5g6Hw4E0Pu0RSMkT6f8PqgsmXJ44pUuj9tAXk1VUMEnyz1772aVPxc5r2Ion54pq0PUZyiR52WJS68-2TLKFFibALnos7ZIhT-EGWS-TGvoK1wNK5z7SM8ACK_EqJLuPuVTiThN96ymFSw_SiU7dP7xXdPHQ_8Nea3nAts8mgyEk-TAib2nYGRReiGGET6MVxZREIYlQ9FAbigVWin-Nvee4Eci49sV5O8vIPaYliEEuuV4ue3X59TfgAoLMZ2iNyUafHkRBGJ0iAdRPMqWLhj4GXG9FnIl-iuV-9bUAvFm7TrNn76dufGmWSkr5Zl7kmU42gLoTofhDN-v9paCTHZFTccc3Sojdv_Ynx3UbFdiX4T4f7w4zDgJbq60uYcMgAydNqfUftV3L_DOU_gOwudkH4S5vacKCJPc"
`
