# Ealore\DateInterval

This is an extension of PHP's \DateInterval with new methods and support for interval specification with both weeks and days at the same time.

## Usage

	<?php
	
	use Ealore\DateInterval;
	
	$interval = new DateInterval('P5W1D');
	
	echo $interval->w; // outputs 5
	echo $interval->d; // outputs 1
	
	
	$legacy = $di->legacy();
	
	echo $legacy->w; // outputs 0
	echo $legacy->d; // outputs 36
	    

## Installation

    composer require "ealore/dateinterval"

