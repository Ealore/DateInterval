[![Build Status](https://travis-ci.org/Ealore/DateInterval.svg?branch=master)](https://travis-ci.org/Ealore/DateInterval)

# Ealore\DateInterval

This is an extension of PHP's \DateInterval with new methods and support for interval specification with both weeks and days at the same time.

## Usage

	<?php

	use Ealore\DateInterval;

	$interval = new DateInterval('P5W1D');

	echo $interval->w; // outputs 5
	echo $interval->d; // outputs 1

### legacy() returns an instance compatible with PHP's \DateInterval

	$legacy = $di->legacy();

	echo $legacy->w; // outputs 0
	echo $legacy->d; // outputs 36

### getIntervalSpec() returns the interval specification string

    $interval = new DateInterval('P5W1D');

    echo $interval->getIntervalSpec(); // outputs P5W1D

## Installation

    composer require "ealore/dateinterval"
