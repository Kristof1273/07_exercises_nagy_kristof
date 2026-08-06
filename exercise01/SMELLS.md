# Code smells found in OrderProcessor class 

### 1. Bloaters - Long Parameter List
The processOrder method expects 10 different parameters.   
Solution: Applied the Introduce Parameter Object refactoring technique by creating dedicated Customer and Product data classes.