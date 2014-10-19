#!/bin/bash

## Variables - dirs without / at the end
# Source mid
mid_dir="./mid"
mid_ext="MID"
# Non-cutted mp3
mp3l_dir="./mp3_uncut"
mp3l_ext="mp3"
# mp3 results
mp3_dir="./mp3"
mp3_ext="mp3"
# Tim for cutting
start="00.07"
duration="01.83" # in seconds
from="00:00:00.10"
to="00:00:01.70"
# Packages required
packages=( "timidity" "lame" "ffmpeg" )

## Functions
function mid2mp3 {
	if [ $# -ne 1 ]; then
		echo "ERROR: midi2mp3 function without file!"
		exit 1;
	fi
	filename=$1
	mid="$mid_dir/$filename.$mid_ext"
	mp3l="$mp3l_dir/$filename.$mp3l_ext"
	echo "-- mid2mp3 $mid -> $mp3l"
	timidity --output-24bit $mid -Ow -o - | lame - -b 64 $mp3l
}

function mp3cut {
	if [ $# -ne 1 ]; then
		echo "ERROR: mp3cut function without file!"
		exit 1;
	fi
	filename=$1
	mp3l="$mp3l_dir/$filename.$mp3l_ext"
	mp3="$mp3_dir/$filename.$mp3_ext"
	echo "-- mp3cut $mp3l -> $mp3"
	#ffmpeg -ss $start -t $duration -i $mp3l -c:v copy -c:a copy $mp3
	mpgsplit $mp3l [$from-$to] -o $mp3
	#cp $mp3l $mp3
}

function all_mid {
	files=( `ls $mid_dir/*.$mid_ext` )
	for file in ${files[@]}; do
		echo "- $file"
		filename="${file%.*}"
		filename="${filename##*/}"
		mid2mp3 $filename
		mp3cut $filename
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
