# Contao MediaQuery

Contao library that sets an cookie via javascript containing browser dimension to check browser viewport dimension in php.

## Currently supported

- width/max-width/max-device-width check
- height/max-height/max-device-height check

For detailed usage check 'HeimrichHannot\MediaQuery\ViewportTest.php'.

## Usage

```
\HeimrichHannot\MediaQuery\Viewport::matchQuery('(min-width: 800px and max-width: 1300px)');
```

Will return true if current browser dimension is between 800px and 1300px, otherwise false.
