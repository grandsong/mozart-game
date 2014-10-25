#!/bin/bash

## Variables - dirs without / at the end
# Source mid
mid_dir="./mid"
mid_ext="MID"
# mp3 results
mp3_dir="./mp3"
mp3_ext="mp3"
# Packages required
packages=( "timidity" "lame" )

## Functions
function mid2mp3 {
	if [ $# -ne 1 ]; then
		echo "ERROR: midi2mp3 function without file!"
		exit 1;
	fi
	filename=$1
	mid="$mid_dir/$filename.$mid_ext"
	mp3="$mp3_dir/$filename.$mp3_ext"
	echo "-- mid2mp3 $mid -> $mp3"
	timidity --output-24bit $mid -Ow -o - | lame - -b 64 $mp3
}

function all_mid {
	files=( `ls $mid_dir/*.$mid_ext` )
	for file in ${files[@]}; do
		echo "- $file"
		filename="${file%.*}"
		filename="${filename##*/}"
		mid2mp3 $filename
	done
}

## Main

missing=0
for package in ${packages[@]}; do
	if [ -z "`which $package`" ]; then
		missing=1
		echo "ERROR: Missing program $package, please install it first!"
	fi
done
if [ $missing -eq 1 ]; then
	exit 1
fi

rm -irf $mp3l_dir
mkdir $mp3l_dir
rm -irf $mp3_dir
mkdir $mp3_dir

all_mid
