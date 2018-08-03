# SAB Pagekit Theme Penta

A pagekit theme using Uikit 3 Beta

# Features

Generally this theme implements almost all Uikit Beta features.

- Each node/site is configurable via the theme tab
- High configurable responsive navbar including main menu and widget positions
- Hero position which supports images, video and even embed content in iframes (e.g. Youtube, Google Maps Embed API)
- Four top and bottom, one footer widget position implementing Uikit's full power of the section, container, background and grid components. Each section is seperately customizable.
- Main section privides two sidebars, a main top and bottom widget position. Available layout for sidebars are two left, two right or one left and one right.
- Settings covering Uikit's card component for the widgets. Each widget can have responsive width and visibility, different headings.
- Download uikit 3, create & compile your own style and add it to this theme

# Limitations

- No automatic build of uikit javascript and less files
- No default node config setable
- No versionizing
- Needs probably rework for broader applicance
- Breaks on update to Vue.js v2

# Setup

- Run `git clone https://github.com/IamSAB/pagekit-theme-penta.git`
- Do `npm install`
- cd to pagekit root and do `php pagekit start`
- open localhost in your browser, enable the theme

# Dev

Run commands below in themes root, after a `npm install`. Be sure to have nodejs and npm installed.

- compile less `npm run gulp`, to watch for changes `npm run gulp watch`
- run webpack e.g. compile js files `npm run webpack`

# Archive

- export the theme as .zip to deploy it on a production environement `npm run archive`
