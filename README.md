# Redirex
A sexy CLI to easily configure 301 redirects from a CSV

## Installation
> stuff will go here

## Guide
### Quickstart
```bash
./redirex generate --I="~/redirects.csv" --O="~/redirects.txt" --F="foo" --R="bar"
```

### Commands
| Flag      | Description                                                                                            | Shorthand | Default                  |
|-----------|--------------------------------------------------------------------------------------------------------|-----------|--------------------------|
| --output  | Absolute path to where the resulting text file will be stored                                          | --O       | ~/.redirex/redirects.txt |
| --find    | Pattern to find in the resulting document. You may pass as many `--find` flags as you need.            | --F       | null                     |
| --replace | String to replace the pattern. **Note: each `--find` flag must have a corresponding `--replace` flag** | --R       | null                     |

------
## Support the development
**Do you like this project? Give me money!**

## License

Redirex is an open-source software licensed under the MIT license.
