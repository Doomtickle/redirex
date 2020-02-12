# Redirex
A sexy CLI to easily configure 301 redirects from a CSV

## Installation
> stuff will go here

## Quickstart
```bash
./redirex generate ~/redirects.csv --O="~/redirects.txt" --F="foo" --R="bar"
```

## Commands
### `generate`
Responsible for generating the 301 redirect text document. Accepts one argument -- the path to the .csv file used to create the redirects.
#### Flags
> --output, --O
* Absolute path to where the resulting text file will be stored

> --find, --F
* Pattern to find in the resulting document. You may pass as many `--find` flags as you need.

> --replace, --R
* String to replace the pattern. **Note: each** `--find` **flag must have a corresponding** `--replace` **flag**

------
## Support the development
**Do you like this project? Give me money!**

## License

Redirex is an open-source software licensed under the MIT license.
