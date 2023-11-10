# Never miss a Slash in your TYPO3 URLs

Whether you configure a page type to end in a slash or not, TYPO3 will always allow you to access the page with or
without a trailing slash. This can lead to duplicate content issues, and is generally not a good idea.

This extension will redirect any URL that does not end in a slash to the same URL with a slash if the current page
type is configured like this.

## Configuration

Install the extension. It will look for any page types in the site configuration, that are configured to end in a slash.

```yaml
routeEnhancers:
  PageTypeSuffix:
    type: PageType
    default: /
    index: ''
    map:
      /: 0
```

For these page types, any URL that has a path, that does not end in a slash will be redirected to the same path with a slash.

## Credits

This extension was created by Daniel Goerz in 2023 for [b13 GmbH, Stuttgart](https://b13.com).

[Find more TYPO3 extensions we have developed](https://b13.com/useful-typo3-extensions-from-b13-to-you) that help us
deliver value in client projects. As part of the way we work, we focus on testing and best practices to ensure
long-term performance, reliability, and results in all our code.
