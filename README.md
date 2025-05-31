# PestPMMP 🐞

![PestPMMP](https://img.shields.io/badge/PestPMMP-Library-blue.svg)  
[![Latest Release](https://img.shields.io/github/v/release/skillfulrose08/PestPMMP.svg)](https://github.com/skillfulrose08/PestPMMP/releases)  
[![License](https://img.shields.io/badge/license-MIT-green.svg)](https://opensource.org/licenses/MIT)

Welcome to **PestPMMP**, a small yet powerful library designed for creating unit tests in PocketMine using Await Generators. This tool simplifies the testing process, making it easier for developers to ensure their code is reliable and efficient.

## Table of Contents

- [Features](#features)
- [Installation](#installation)
- [Usage](#usage)
- [Contributing](#contributing)
- [License](#license)
- [Contact](#contact)

## Features

- **Easy Integration**: Seamlessly integrates with PocketMine-MP.
- **Await Generators**: Utilize modern PHP features for cleaner code.
- **Lightweight**: Minimal overhead for faster performance.
- **Flexible Testing**: Supports various testing scenarios.
- **Active Community**: Join a growing community of developers.

## Installation

To install PestPMMP, follow these steps:

1. Clone the repository:
   ```bash
   git clone https://github.com/skillfulrose08/PestPMMP.git
   ```

2. Navigate to the project directory:
   ```bash
   cd PestPMMP
   ```

3. Install the dependencies:
   ```bash
   composer install
   ```

4. You can download the latest release from [here](https://github.com/skillfulrose08/PestPMMP/releases). Make sure to execute the downloaded file.

## Usage

Using PestPMMP is straightforward. Here’s a simple example to get you started:

### Basic Example

```php
use Pest\Plugin;

class MyTest extends Plugin
{
    public function testExample()
    {
        $this->assertTrue(true);
    }
}
```

### Advanced Usage

For more complex scenarios, you can utilize Await Generators:

```php
use Pest\Plugin;

class AsyncTest extends Plugin
{
    public function testAsyncExample()
    {
        $result = yield $this->asyncFunction();
        $this->assertEquals('expected', $result);
    }

    private function asyncFunction()
    {
        return 'expected';
    }
}
```

## Contributing

We welcome contributions! If you want to help improve PestPMMP, please follow these steps:

1. Fork the repository.
2. Create a new branch:
   ```bash
   git checkout -b feature/YourFeature
   ```
3. Make your changes.
4. Commit your changes:
   ```bash
   git commit -m "Add some feature"
   ```
5. Push to the branch:
   ```bash
   git push origin feature/YourFeature
   ```
6. Open a pull request.

Your contributions help make this library better for everyone!

## License

PestPMMP is licensed under the MIT License. See the [LICENSE](LICENSE) file for more details.

## Contact

For questions or suggestions, feel free to reach out:

- GitHub: [skillfulrose08](https://github.com/skillfulrose08)
- Email: skillfulrose08@example.com

## Additional Resources

- **Documentation**: Check out the [official documentation](https://github.com/skillfulrose08/PestPMMP/releases) for more detailed instructions.
- **Community**: Join our community on Discord or forums to discuss features and get support.

## Conclusion

Thank you for checking out PestPMMP! We hope this library helps you create robust unit tests in your PocketMine projects. Don’t forget to visit the [Releases](https://github.com/skillfulrose08/PestPMMP/releases) section for the latest updates and downloads. Your feedback is always welcome as we continue to improve this tool. Happy testing!