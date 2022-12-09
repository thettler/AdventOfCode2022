import fileinput
import re

counter=0
for line in fileinput.input():
    line = line.strip()

    a1,a2,b1,b2=[int(x) for x in re.split(',|-',line)]

    for i in range(a1,a2+1):
        if i in range(b1,b2+1):
            counter+=1
            break

print(counter)