# Control 2 

## Table of content 

<!--toc:start-->
- [Control 2](#control-2)
  - [Table of content](#table-of-content)
  - [About this exercice](#about-this-exercice)
  - [Pre requisite](#pre-requisite)
  - [Objective](#objective)
  - [Bonus points](#bonus-points)
    - [Git repository +2](#git-repository-2)
<!--toc:end-->

## About this exercice

This exercice is to test your abilities to translate imperative PHP code into OOP code

## Pre requisite

You would need to know how PHP works. You need to know OOP to get the most out of the exercices.

## Objective

The provided code in `index.php` is reading a CSV file. In this, there are 2 columns of number. For each number in the left column, the script is counting their occurences in the right column and multiply those 2 numbers. Then, it adds all the multiplication results.

For example :

```
3   4
4   3
2   5
1   3
3   9
3   3
```

The first number in the left column is `3`, and it appears 3 times in the right column. The first operation is `3 * 3 = 9`. Then, the seconde number in the left column is `4` and it appears 1 time in the right column. The second operation is `4 * 1 = 4`. And so on. In the end, the result should be `9 + 4 + 0 + 0 + 9 + 9 = 31`.

The provided script is functionnal and has been tested. Your objective is to turn this script into a OOP style, without losing any feature. 

## Bonus points

### Git repository +2

- working with branches
- doing atomic commits using [conventional commits](https://www.conventionalcommits.org/en/v1.0.0/)
- doing PR or merges from your working branch to your main branch once a task is completed
