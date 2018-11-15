# surlf

[![Build Status](https://travis-ci.org/jmsfwk/surlf.svg?branch=master)](https://travis-ci.org/jmsfwk/surlf)

## Usage

```php
use Jmsfwk\Surlf\Formatter;

echo Formatter::format('%h/%p', 'http://example.com/a-path');
// example.com/a-path
```

## Formats
The examples in the table below are based on the url `http://example.com/a/b/c?d=e&f=g`.

|Format character|Description        |Example    |
|----------------|-------------------|-----------|
|s               |URL scheme         |http       |
|h               |Host               |example.com|
|p               |Path               |a/b/c      |
|q               |Query              |d=e&f=g    |
|%               |Literal % character|%          |
