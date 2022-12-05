import fileinput

count = 0
kcalPerElf=[]
for line in fileinput.input():
    line = int(line.strip() or 0)
    
    if (line==0):
        kcalPerElf.append(count)
        count = 0
    count+=line

kcalPerElf.sort(reverse=True)
print(sum(kcalPerElf[0:3]))