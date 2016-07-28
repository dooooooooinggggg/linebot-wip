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

    if receivetext == '行き':
    	nowhour   = datetime.now().strftime('%H')
    	nowminute = datetime.now().strftime('%M')
    	nowtime   = nowhour + nowminute

    	nowtime = int(nowtime)
    	nowtime = 952#仮

    	gotimetable = timetable.gotimetable
    	#gotimetablekeys = gotimetable.keys().sort()
    	timelist = gotimetable.keys()
    	timelist = sorted(timelist)


    	index = np.searchsorted(timelist,nowtime)
    	if index == len(timelist):
    		sendtext = 'バスはもう終わりました。'
    	else:

    		#タイムテーブルを参照
    		#リストから時間のみ(keys)を読み出す
    		#現在の時間のindexを出す
    		#そのindexのオブジェクトとその次を返す
    		nextindex = timelist[index]
    		firstbus = gotimetable[nextindex]


    		nexttime = str(timelist[index])

    		sendtext = "次のバスは" + nexttime + "の" + firstbus + "です"
    		sendtext = str(sendtext)
    else:
    	sendtext = "「行き」って入力してください。"

    #ここまで

    print sendtext#ここでphpに戻している。