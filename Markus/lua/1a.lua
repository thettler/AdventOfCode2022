local count=0
local maxCount=0

for line in io.lines("../input1.txt") do
    if line=='' then
        line=0
        maxCount=math.max(count,maxCount)
        count=0
    end
    count=count+tonumber(line)
end

print(maxCount)