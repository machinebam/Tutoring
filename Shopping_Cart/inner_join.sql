SELECT item_id, item_name, unit_price, picture_file_name
FROM items_orders
    INNER JOIN items
        ON items_orders.item_id = items.id

WHERE items_orders.order_id = 1