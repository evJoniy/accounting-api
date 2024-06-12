## SOLID

- S 

TransactionController: Handles HTTP requests and responses.

TransactionService: Transactions business logic.

TransactionRepository: Transactions data access logic.

TransactionFilter: Encapsulates transactions filtering logic.

### - O 

TransactionFilter: Can be extended to add new filtering criteria without modifying the existing code.

CurrencyExchangeFactory: Allows to add new drivers without modifying the factory's logic.

### - L

All drivers (XML, JSON, CSV) implement CurrencyExchangeDriverInterface interface. Any driver can be used interchangeably without affecting the functionality

### - I 

TransactionRepositoryInterface: Defines only the methods needed for transaction-related data operations.

CurrencyExchangeDriverInterface: Defines only the method required to get the exchange rate.

### - D
TransactionService depends on TransactionRepositoryInterface rather than on a concrete.

CurrencyConversionService depends on CurrencyExchangeDriverInterface rather than specific driver implementations.
### -------------------------------------------------------------------------------
## PHPDocs

Allows to declare and/or specify params for a signature. Can be inherited from parent/interface. Clarifies params for a call with IDE hits and complains

Set of Docs be seen in app/Repositories/TransactionRepository

## PHP 7

..is dead, as well as 8.0 already.

Type and nullable hints, properties type hinting, return types, mixed types, coalesce ?? ?: operators

### PHP 8: 
Nullable arrow calls, short constuctor, intersection and union types, readonly

