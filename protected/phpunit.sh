dir=`dirname $0`
phpunit="$dir/../vendor/bin/phpunit -c $dir/tests/phpunit.xml"
tests="$dir/tests"

if [ "$1" != "" ]; then 
	$phpunit $1
else
	$phpunit $tests
fi
