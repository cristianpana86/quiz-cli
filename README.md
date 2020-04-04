
# Quiz CLI
> This is the CLI tool to train on certifications.

## How it looks?

![Certificationy application](https://cloud.githubusercontent.com/assets/1247388/17698070/434e3944-63b9-11e6-80c6-91706dbbea50.png "Certificationy application")

## More run options

### Select the number of questions
```
$ php quiz.php start --number=10
```

The default value is 20.

### List categories
```
$ php quiz.php start --list [-l]
```

Will list all the categories available.

### Only questions from certain categories
```
$ php quiz.php start "Automated tests" "Bundles"
```

Will only get the questions from the categories "Automated tests" and "Bundles".

Use the category list from [List categories](#list-categories).

### Hide the information that questions are/aren't multiple choice
```
$ php quiz.php start --hide-multiple-choice
```

As default, the information will be displayed.

![Multiple choice](https://cloud.githubusercontent.com/assets/795661/3308225/721b5324-f679-11e3-8d9d-62ba32cd8e32.png "Multiple choice")

### Training mode: the solution is displayed after each question
```
$ php quiz.php start --training
```

### Set custom configuration file
```
$ bin/certificationy start --config=../config.yml
```

Will set custom config file.

### And all combined
```
$ php quiz.php start --number=5 --hide-multiple-choice "Automated tests" "Bundles"
```

* 5 questions
* We will hide the information that questions are/aren't multiple choice
* Only get questions from category "Automated tests" and "Bundles"

> Note: if you pass `--list [-l]` then you will ONLY get the category list, regarding your other settings.