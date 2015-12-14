import json
import re
import requests 
import sys


def set_info(argv): 
    errors = " unable to retrieve information "
    call = requests.get( 'http://freegeoip.net/json/' + argv)
    if call.status_code == 404:
       return errors
    else:
       data = call.json()  
       time_zone = data['time_zone']
       city = data['city']
    
    weather_info = requests.get('http://api.wunderground.com/api/97036736008cd2dd/conditions/q/'+time_zone +"/"+city +'.json')
    if weather_info.status_code == 404:
    	return errors
    else:
        pattern = 	weather_info.json()
        link = pattern['location']['city']
        return link

if __name__ == '__main__':
	print(set_info(sys.argv[1])) 


