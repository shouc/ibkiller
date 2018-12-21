### Mate finding

API:

1. MateController@findMate

Return a mate available in accordance to user's grade. If no match, then insert the user into the database. 

Algorithm: $$1-\frac{|\text{gradeN} - \text{gradeO}| \cdot 60\%}{12} - \frac{\text{distance} \cdot 40\%}{14000} < 0.9$$

2. MateController@listMate

Return 5 mate with all information with highest algorithm value.

Algorithm: $$1-\frac{|\text{gradeN} - \text{gradeO}| \cdot 60\%}{12} - \frac{\text{distance} \cdot 40\%}{14000}$$

3. MateController@reportSpam

Insert to database and send to scf@ieee.org

```
We will give you reponse in five days and assign you a new mate.
```

4. MateController@stopMate

Check if the mate also has used the function, if yes, then call MateController@findMate and call MateController@findMate for this user's mate. 

```
Your mate has not stopped the relationship, you could either choose to report spam or remind your mate for stopping it. Whenever your mate stops, we will assign you a new mate.
```

