[![Build Status](https://travis-ci.org/Ealore/DateInterval.svg?branch=master)](https://travis-ci.org/Ealore/DateInterval)

# Ealore\DateInterval

This is an extension of PHP's \DateInterval with new methods and support for interval specification with both weeks and days at the same time.

## Usage

	<?php

	use Ealore\DateInterval;

	$interval = new DateInterval('P5W1D');
	// it is possible to specify both weeks and days at the same time

	echo $interval->w; // outputs 5
	echo $interval->d; // outputs 1

### legacy() returns an instance compatible with PHP's \DateInterval

	$legacy = $di->legacy();

	echo $legacy->w; // outputs 0
	echo $legacy->d; // outputs 36

### getIntervalSpec() returns the interval specification string

    $interval = new DateInterval('P5W1D');

    echo $interval->getIntervalSpec(); // outputs P5W1D

    $zero_interval = new DateInterval('P0D');

    echo $interval->getIntervalSpec(); // outputs P0D

## Installation

    composer require ealore/dateinterval

## Changelog

version 1.0.1
- added a check to getIntervalSpec()

version 1.0

- added `w` property
- added `legacy()` method to fetch an instance of PHP's \DateInterval
- added `getIntervalSpec()` that returns the interval specification string. If the interval duration is 0, the original interval_spec is returned.
