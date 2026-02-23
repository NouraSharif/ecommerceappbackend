//هذا الملف خاص باستعلامات عرض الداتا



//دمج المنتجات مع الاقسام 
//لانه بحتاج الاقسام للمنتجات ممكن احتاج معلومات قسم هذا المنتج
//بالتالي انشأت ملف عبارة عن عرض داتا ناتجة عن كزا مثلا
//itemsview 



//جيبلي المنتجات المضافة للمفضلة ولا لا
//من خلال الكولوم اللي ضفناه 
//حطينا قيمته واحد بحال المنتجات انضافة للمفضلة وزيرو ازا ما انضافت

SELECT itemsview.* ,1 AS favorite FROM `itemsview` 
INNER JOIN favorite ON favorite.favorite_usersid= 42 AND favorite.favorite_itemsid=itemsview.items_id 
UNION ALL
SELECT *,0 AS favorite FROM `itemsview` 
WHERE itemsview.items_id  NOT IN (SELECT itemsview.items_id FROM `itemsview` INNER JOIN favorite ON favorite.favorite_usersid= 42 AND favorite.favorite_itemsid=itemsview.items_id)

//لعرض البيانات من المفضلة
//من خلال جدول الفيفرت ==حيث يوجد علاقة مني تو مني بين المستخدم والمنتج

//رح نحتاج جدول الفيفرت 
//رح نعرض جميع التفاصيل الخاصة بالمنتج 
//ومين المستخدم اللي ضاف هاي المنتجات للمفضلة
CREATE OR REPLACE VIEW myfavorite AS
SELECT * FROM `favorite` 
INNER JOIN users ON favorite.favorite_usersid=users.users_id
INNER JOIN items ON favorite.favorite_itemsid=items.items_id


//حساب كمية المنتجات وسعر المنتجات حسب هاي الكمية
//المنتجات داخل السلة
CREATE OR REPLACE VIEW cartview AS
SELECT SUM(items_price) AS itemsprice,COUNT(cart_itemsid) AS countitems,cart.*,items.* FROM cart
INNER JOIN items ON items_id=cart_itemsid
GROUP BY cart_itemsid,cart_usersid