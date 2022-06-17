# FAQ - Read if you are a merchant.

**Q. My products and categories got deleted when using OCUnit.**

A. Yes, it will, it does, and it is intended. Do NOT run OCUnit in a live database.
It will even overwrite more information.

You cannot claim for a loss, nor OCUnit guarantees a recovery. It is developed voluntarily.

OCUnit is a risky product for your live database. Always clone your database for use with OCUnit.

**Q. Is there a technical support provided?**

A. Not officially. But if something is wrong, you can still request a new issue in [GitHub](https://github.com/anytizer/ocunit/issues/new).

**Q. Why is OCUnit written in such a descructive way?**

A. The developer(s) of OCUnit believe that the website owner should be responsible for managing the user behaviour in
the website. It includes data loss by accidental damage by staffs. For a better recovery of the website, the owner
should not go through a hassle. So, catalog information is created first, and then the OpenCart database.

OCUnit does not promise a full recovery; but the catalog of products are built from your memos.

**Q. How do I write memos?**

A. please see [ini/categories](ini/categories).

**Q. How many levels of categories do you support?**

A. One. Top level categories. A child folder is a product under selected category.

**Q. How do I configure for the first use?**

A. First, install opernart in your location, eg: http://localhost/oc/opencart/ and then point the path in [ini/config.ini](ini/config.ini).
The beloow lines:

https://github.com/anytizer/ocunit/blob/63052aff69f81bef08372cc1ae7a68c4d32021ad/ini/config.ini#L9-L10

