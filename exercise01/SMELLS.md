# Code smells found in OrderProcessor class 

### 1. Bloaters - Long Parameter List
The processOrder method expects 10 different parameters.   
Solution: Applied the Introduce Parameter Object refactoring technique by creating dedicated Customer and Product data classes.

### 2. Bloaters - Data Clumps
Customer and product data, as well as calculation results ($subtotal, $tax, $total), were passed around and manipulated in groups.  
Solution: Extracted these data clumps into dedicated Customer, Product, and OrderResult data classes.

### 3. Object-Orientation Abuser - Divergent Change / God Object
The OrderProcessor violates the Single Responsibility Principle by handling calculations, database operations, notifications, and logging together. It has too many reasons to change.  
Solution: Applied the Extract Method to split processOrder into dedicated private methods, leaving the main method to act purely as an orchestrator.