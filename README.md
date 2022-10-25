<p align="center">
    <h1 align="center">Тестовое задание</h1>
    <br>
</p>

<pre>
Имеем интернет-магазин с товарами разных категорий (продукты, бытовая техника, электроника и т.д.).
Товар имеет следующие атрибуты:
- название (обязательный)
- описание
- цена (обязательный)
- количество (обязательный)
- категория (обязательный)

Категория у товара может быть как одна, так и несколько.

1. Реализовать механизм добавление / изменения / удаления товаров с валидацией данных.
Например: 
- Нельзя добавить товар в количестве 0 штук
- Нельзя добавить товар с отрицательной ценой.
- Название должно быть от 10 до 100 символов.
- Товар не может быть без категории.

2. Реализовать виртуальный счет, на котором будут храниться деньги в одной валюте (USD)
- Этот счет можно пополнить
- С этого счета можно списать деньги.
- Должна быть история операций по этому счету.

3. Реализовать механизм оплаты товаров с помощью воображаемого эквайринга с зачислением денег на виртуальный счет.

4. В какой-то момент руководство приняло решение 20% от поступлений на счет отправлять на благотворительность.
Имеется несколько организаций, куда можно отправить деньги.
Отправка денег происходит в рандомную организацию, но в одну и ту же организацию второй раз в день можно отправить только если во все другие организации уже были отправлены деньги.

4.1 Нужно понимать, получен отправленный нами платеж на благотворительность или нет. Организация нам не может об этом сообщить сразу, т.к деньги идут через промежуточный банк.
Но если сделать запрос к этой организации и спросить, а получен ли платеж с номером №, то она ответит Да или нет, если Да, то какого числа.</pre>

<h2>Алгоритм</h2>
<pre>
1). Добавление категории:
POST http://localhost/api/v1/categories
Content-Type: application/json

{ "name" : "Категория 1"}

2). Добавление товара:
POST http://localhost/api/v1/goods
Content-Type: application/json

{ "name" : "Товар 1 Категории 1", "cost" : 1,  "quantity" : 1,  "categoryIds" : [1]}

3). Просмотр списка товаров и их категорий:
GET http://localhost/api/v1/goods?expand=categories

4). Редактирование товара:
PATCH http://localhost/api/v1/goods/1
Content-Type: application/json

{ "cost" : 1.59 }

5). Удаление товара:
DELETE http://localhost/api/v1/goods/1

</pre>

<h2>Комментарии</h2>
<pre>
1). Сделан только первый пункт ТЗ.
2). Заюзал sqlite, т.к. сходу не смог запустить mysql в докере, а времени разбираться не было.
Надеюсь, не критично.
</pre>