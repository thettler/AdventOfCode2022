import fileinput

x=0
y=14
sub=[]
for line in fileinput.input():
    line=line.strip()

    sig=list(line)
    
    while y<len(sig)+1:
        sub=sig[x:y]
        if len(sub)==len(set(sub)):
            print(y)
            break
        x+=1
        y+=1