<?php

class Status {

	const ERR_AUTHEN_INVALID = 300;
	const ERR_AUTHEN_INVALID_MSG = 'Username หรือ Password ไม่ถูกต้อง';


	# 4:: products 

	const ERR_NO_PRODUCT_IN_DB = 400;
	const ERR_NO_PRODUCT_IN_DB_MSG = 'ข้อมูล Products ใน database ว่างเปล่า';
	const ERR_PRODUCT_DUPLICATE = 401;
	const ERR_PRODUCT_DUPLICATE_MSG = 'พบ Product ซ้ำในระบบ';

}