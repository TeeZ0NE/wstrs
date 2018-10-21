# Banker op
![](https://github.com/TeeZ0NE/banker/blob/dev/resources/graph/db.jpg)
+ Seed tables with data using a flag `--seed`
+ PHPUnit testing with _CustomerTest_

**CNP**

`APP_URL/customer/Tomer/8888444422221111?yy=22&mm=10&cvv2=545`

| attr | comment |
|:--:|--|
|cno(cnp)|card number (16 digit)|
|yy|expire year|
|mm|expire day|
|cvv2|not decoded CVV2 (dangerous)|


## Models
### Card
A User can have more then one card but and we should have one more URI attribute like a card_id. 
Method `getFirstCardId` will return first matching user's card.
### Transaction
The model has relations with User and Card.
A method _getFullTransactionSearch_ using condition `And` but if we want to get wider results we should to use `Or` condition.
A filter method takes attributes, f.e.
`APP_URL/transaction/2/filter?date=20.10.2018&amount=12.56`

Date can be in different variations:

- 20.10.2018
- 2018-10-20
- or 2018_10_20

_customerid_, _amount_ and _date_ is required but offset (by default is 0) and limit (is 1) will fill with defaults. Feel free to change attributes sequence