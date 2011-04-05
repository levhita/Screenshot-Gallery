#!/bin/bash
# Takes a screenshot, generates 3 diferent resolution files,and upload them
# to a FTP server, the generated files workgreat with the PHP file.
# @author Argel Arias <levhita@gmail.com>
# @package Screenshots Gallery
# @link http://levhita.net/screenshots_gallery/
# @license GPL of course

HOST=YourHost.com
USER=YouFtpUser
PASSWORD=YourFtpPassword
REMOTE_DIR=your/remote/path
IMAGES_DIR=~/where/do/you/want/to/store/files/locally
DATE=$(date +%Y-%m-%d-%H-%M-%S)

echo 'taking screenshot...'
scrot "screenshot-full-${DATE}.png"

echo 'generating thumbnail...'
convert -size 204x153 screenshot-full-${DATE}.png -strip  -depth 8  -colors 256  -quality 95 -thumbnail 204x153 screenshot-full-${DATE}-thumb.png

echo 'resizing sample...'
mogrify -resize 800x600 -format jpg -quality 75% screenshot-full-${DATE}.png

echo 'locating files...'
mv screenshot-full-${DATE}.jpg ${IMAGES_DIR}/screenshot-${DATE}.jpg
mv screenshot-full-${DATE}.png ${IMAGES_DIR}/screenshot-${DATE}-full.png
mv screenshot-full-${DATE}-thumb.png ${IMAGES_DIR}/screenshot-${DATE}-thumb.png

echo 'uploading sample...'
ftp -i -n  $HOST<<**
user $USER $PASSWORD
binary
send ${IMAGES_DIR}/screenshot-${DATE}.jpg ${REMOTE_DIR}/screenshot-${DATE}.jpg
bye
**

echo 'uploading screenshot...'
ftp -i -n  $HOST<<**
user $USER $PASSWORD
binary
send ${IMAGES_DIR}/screenshot-${DATE}-full.png ${REMOTE_DIR}/screenshot-${DATE}-full.png
bye
**

echo 'uploading thumbnail...'
ftp -i -n  $HOST<<**
user $USER $PASSWORD
binary
send ${IMAGES_DIR}/screenshot-${DATE}-thumb.png ${REMOTE_DIR}/screenshot-${DATE}-thumb.png
send ${IMAGES_DIR}/screenshot-${DATE}-thumb.png ${REMOTE_DIR}/thumbnail.png
bye
**

echo 'done.'
