#!/bin/bash
file=cms.readfiend.com/scripts/feedlist.txt
BASE_PATH=/var/www/readfiend
FEEDS_PATH=feeds.readfiend.com

#BASE_PATH="feeds"
# set the Internal Field Separator to |
IFS='|'
#go to 

gobase () {
   cd $BASE_PATH;
}
#go to base 
gobase

while read -r provider url target_file
do
#if provider does not exit create it.
    PROVIDER_DIRECTORY="${BASE_PATH}/${FEEDS_PATH}/${provider}/bucket"
    echo "\n\n--------------------------------------------------";
    echo "Proccessing ... PROVIDER => ${provider}  FEED URL => ${url}"
    if [  -z $provider ] || [ -z $url ]; then
	echo "[Error] Skipping...";
        continue;
    fi 
    if [ -d "$PROVIDER_DIRECTORY" ]; then
        echo "${PROVIDER_DIRECTORY} exists"
        echo "downloading ... "
        echo 'curl -o ${PROVIDER_DIRECTORY}/$target_file $url > /dev/null 2>/dev/null &'
        curl -o ${PROVIDER_DIRECTORY}/$target_file $url > /dev/null 2>/dev/null &        
    else 
	echo "Directory does not exist for << $provider{} >>";
        echo "Creating directories: ${PROVIDER_DIRECTORY} ...";
        mkdir -p "${FEEDS_PATH}/${provider}/bucket"
        mkdir -p "${FEEDS_PATH}/${provider}/success"
        mkdir -p "${FEEDS_PATH}/${provider}/fail"
        echo "Success" 
        echo "downloading ... "
        echo 'curl -o ${PROVIDER_DIRECTORY}/$target_file $url > /dev/null 2>/dev/null &'
        curl -o ${PROVIDER_DIRECTORY}/$target_file $url > /dev/null 2>/dev/null &        
    fi
done < "$file"

