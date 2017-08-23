'use strict';
const Generator = require('yeoman-generator');
const chalk = require('chalk');
const yosay = require('yosay');
const rename = require('gulp-rename');
const _ = require('underscore.string');

module.exports = class extends Generator {
  prompting() {
    // Have Yeoman greet the user.
    this.log(yosay(
      'YO! Welcome to the ' + chalk.red('WordPress Plugin') + ' Generator!'
    ));

    const prompts = [{
      type: 'input',
      name: 'pluginName',
      message: 'Plugin Name ->',
      default: 'My Plugin',
      filter: input => input.replace(/\b\w/g, l => l.toUpperCase())
    },
    {
      type: 'input',
      name: 'pluginSlug',
      message: 'Plugin Slug ->',
      default: answers => _.slugify(answers.pluginName),
      filter: input => _.slugify(input)
    },
    {
      type: 'input',
      name: 'pluginShortName',
      message: 'Plugin Short Name ->',
      default: answers => answers.pluginName.match(/\b\w/g).join(''),
      filter: input => input.replace(/\b\w/g, s => s.toUpperCase())
    },
    {
      type: 'input',
      name: 'pluginSingleton',
      message: 'Plugin Singleton ->',
      default: answers => answers.pluginShortName.replace(/\s+|-/g, '_').toLowerCase(),
      filter: input => input.replace(/\s+|-/g, '_')
    },
    {
      type: 'input',
      name: 'authorName',
      message: 'Plugin Author ->',
      default: 'SAU/CAL'
    },
    {
      type: 'input',
      name: 'authorEmail',
      message: 'Plugin Author Email ->',
      default: 'info@saucal.com'
    },
    {
      type: 'input',
      name: 'authorURI',
      message: 'Plugin Author URI ->',
      default: 'https://saucal.com'
    }
    ];

    return this.prompt(prompts).then(props => {
      // To access props later use this.props.someAnswer;
      this.props = props;
      this.props.plugin_name = props.pluginName.replace(/\s+|-/g, '_').toLowerCase();
      this.props.pluginShortNameUpper = props.pluginShortName.replace(/\s+|-/g, '_').toUpperCase();
      this.props.pluginShortSlug = _.slugify(props.pluginShortName);
      this.props.pluginClass = props.pluginName.replace(/\s+/g, '_');
      this.props.pluginShortClass = props.pluginShortName.replace(/\s+/g, '_');
    });
  }

  writing() {
    const slug = _.slugify(this.props.pluginSlug);
    const shortSlug = _.slugify(this.props.pluginShortName);
    this.registerTransformStream(rename(function (path) {
      path.basename = path.basename.replace('plugin-name', slug).replace('pname', shortSlug);
    }));

    this.fs.copyTpl(
      this.templatePath(),
      this.destinationPath(slug),
      this.props
    );
    // this.fs.copyTpl(
    //   `${this.templatePath()}/plugin-name/(plugin-name)*`,
    //   this.destinationPath(`${slug}`),
    //   this.props
    // );
  }

  // install() {
  //   this.installDependencies();
  // }
};
