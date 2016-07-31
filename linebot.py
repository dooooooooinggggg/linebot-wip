# file name: linebot.py
# coding:utf-8
 
import sys
import timetable
from datetime import datetime
import numpy as np
import operator

if __name__=='__main__':


    receivetext = sys.argv[1]
    #receivetext = '行き'
    #ここに処理を書く

    if receivetext == '行き' or receivetext == '帰り':
    	nowhour   = datetime.now().strftime('%H')
    	nowminute = datetime.now().strftime('%M')
    	nowtime   = nowhour + nowminute

    	nowtime = int(nowtime)
    	if receivetext == '行き':
    		timetable = timetable.gotimetable
    	elif receivetext == '帰り':
    		timetable = timetable.backtimetable
    	timelist = timetable.keys()
    	timelist = sorted(timelist)


    	index = np.searchsorted(timelist,nowtime)
    	if index == len(timelist):
    		sendtext = 'バスはもう終わりました。'
    	else:
    		nextindex = timelist[index]
    		firstbus = timetable[nextindex]


    		nexttime = str(timelist[index])

    		sendtext = "次のバスは" + nexttime + "の" + firstbus + "です"
    		sendtext = str(sendtext)
    else:
    	sendtext = "「行き」って入力してください。"

    print sendtext