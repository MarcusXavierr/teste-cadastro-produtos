SELECT tag.id ,tag.name AS "Tag", COUNT(product_tag.tag_id) AS "Produtos" 
FROM tag LEFT JOIN product_tag ON product_tag.tag_id = tag.id 
GROUP BY tag.name ORDER BY COUNT(tag.name) DESC; 