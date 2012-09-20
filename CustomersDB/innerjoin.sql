SELECT customers.FIRSTNAME , addresses.STREET
FROM addresses
INNER JOIN customers
ON addresses.id=addresses.`CUSTOMER_ID`
WHERE customers.id = 1;