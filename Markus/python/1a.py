import fileinput

count = 0
maxCount = 0
for line in fileinput.input():
    line = int(line.strip() or 0)
    
    if (line==0):
        if (count>maxCount):
            maxCount = count
        count = 0
    count+=line

print(maxCount)