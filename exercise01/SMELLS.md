# Code smells found in OrderProcessor class 

### 1. Bloaters - Long Parameter List
The processOrder method expects 10 different parameters.   
Solution: Applied the Introduce Parameter Object refactoring technique by creating dedicated Customer and Product data classes.

### 2. Bloaters - Data Clumps
Customer and product data, as well as calculation results (`$subtotal`, `$tax`, `$total`), were passed around and manipulated in groups.
**Solution:** Extracted these data clumps into dedicated `Customer`, `Product`, and `OrderResult` data classes.