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

### 4. Dispensables - Dead Code
The exact same notification message string is duplicated for both email and SMS sending.  
Solution: Applied the Extract Variable refactoring technique to store the formatted message string in a single local variable and reused it across both notification methods.

### 5. Dispensables - Comments
The method was filled with explanatory comments acting as section headers for each block of code.  
Solution: Removed the redundant comments, because the newly extracted methods have clear and descriptive names that make the code self-documenting.

### 6. Coupler - Hardcoded Instantiation
The OrderProcessor tightly couples itself to the SmsService by instantiating it directly using the new keyword. This violates the Dependency Inversion Principle and makes the class impossible to unit test.  
Solution: Applied Dependency Injection by removing the hardcoded instantiation and passing the SmsService as a class-level dependency, allowing for mock objects during testing.