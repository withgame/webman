VERSION=`git tag | head -1`
VERSION_LATEST=`git tag | tail -n 1`
VERSION_MASTER=master
COMMIT=`git rev-parse --short HEAD`
BUILDDATE=`date "+%Y-%m-%d/%H:%M:%S"`
APP_NAME=webman.phar

clean:
	rm -rf ${APP_NAME}

install:
	composer install

build: install clean
	php build.php ${APP_NAME} --version=${VERSION} --commit=${COMMIT} --build=${BUILDDATE}
