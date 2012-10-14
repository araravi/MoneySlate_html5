module Sim where

-- the signal that is always on "High"
high::[Bool]
high = True:high

-- the signal that is always on "Low"
low::[Bool]
low = False:low

-- create a limited list, of length "n", filled with logical value "fill"
-- useful to create signals by appending finite sequences
set :: Integer -> Bool -> [Bool]
set 0 _ = []
set n fill | n>0 = fill:(set (n-1) fill)

-- delay a signal by "n" clock cycles
-- prepends "n" instances of "fill" to the signal
delay :: Integer -> Bool -> [Bool] -> [Bool]
delay n fill s = (set n fill) ++ s

-- the inverter gate inverts every level for the entire signal,
-- and also delays the signal by one clock cycle
not_gate :: [Bool] -> [Bool]
not_gate s = delay 1 True (map not s)

clock :: [Bool]
clock = not_gate clock

-- and gate delays its output by 2 clock cycles
and_gate :: [Bool] -> [Bool] -> [Bool]
and_gate i1 i2 = delay 2 True (zipWith (&&) i1 i2)

srneg_latch :: [Bool]->[Bool]->[Bool]
srneg_latch s r = 
  let (q,qbar,w1,w2) = (not_gate w1,not_gate w2,and_gate s qbar,and_gate r q) in q

and_gate3 :: [Bool] -> [Bool] -> [Bool] -> [Bool]
and_gate3 i1 i2 i3 = (zipWith (&&) i1 (zipWith (&&) i2 i3))

nand_gate :: [Bool] -> [Bool] -> [Bool]
nand_gate i1 i2 = not_gate (and_gate i1 i2)

nand_gate3 :: [Bool] -> [Bool] -> [Bool] -> [Bool]
nand_gate3 i1 i2 i3 = not_gate (and_gate3 i1 i2 i3)

jk_gate2 :: [Bool] -> [Bool] -> [Bool] -> [Bool]
jk_gate2 j c k =
	let (w1,w2,qbar,q) =
		(nand_gate3 qbar j c,
		nand_gate3 c k q,
		nand_gate q w2,
		nand_gate w1 qbar
		) in q

and_gate1 :: [Bool] -> [Bool] -> [Bool]
and_gate1 i1 i2 = (zipWith (&&) i1 i2)

jkflipper :: Bool -> Bool -> Bool -> Bool -> Bool
jkflipper False True False q = q
jkflipper False False False q = q
jkflipper False True True q = False
jkflipper False False True q = q
jkflipper True True False q = True
jkflipper True False False q = q
jkflipper True True True q = not q
jkflipper True False True q = q

jk_gatehelper :: [Bool] -> [Bool] -> [Bool] -> Bool -> [Bool]
jk_gatehelper (j:js) (c:cs) (k:ks) q = q:(jk_gatehelper js cs ks (jkflipper j c k q))

jk_gate :: [Bool] -> [Bool] -> [Bool] -> [Bool]
jk_gate j c k = delay 0 True (delay 1 False (jk_gatehelper j c k False))

jk_gate1 :: [Bool] -> [Bool] -> [Bool] -> [Bool]
jk_gate1 j c k = delay 0 True (delay 1 False (jk_gatehelper j c k False))

jk_zipper :: (a -> b -> c -> d -> e) -> [a] -> [b] -> [c] -> [d] -> [e]
jk_zipper z (a:as) (b:bs) (c:cs) (d:ds) = z a b c d : jk_zipper z as bs cs ds

jkflipflop :: [Bool] -> [Bool] -> [Bool] -> [(Bool,Bool,Bool,Bool)]
jkflipflop j c k = let (q1,q2,q3,q4) = (delay 10 True (jk_gate j c k), delay 8 True (jk_gate q1 c q1), delay 6 True (jk_gate (and_gate q1 q2) c (and_gate q1 q2)), delay 4 True (jk_gate (and_gate (and_gate q1 q2) q3) c (and_gate (and_gate q1 q2) q3))) in jk_zipper (\p q r s -> (s,r,q,p)) q1 q2 q3 q4

jkflipflop1 :: [Bool] -> [Bool] -> [Bool] -> [(Bool,Bool,Bool,Bool)]
jkflipflop1 j c k = let (q1,q2,q3,q4) = (jk_gate1 j c k, jk_gate1 q1 c q1, jk_gate1 (and_gate1 q1 q2) c (and_gate1 q1 q2), jk_gate1 (and_gate1 (and_gate1 q1 q2) q3) c (and_gate1 (and_gate1 q1 q2) q3)) in jk_zipper (\p q r s -> (s,r,q,p)) q1 q2 q3 q4

booleanconvert a = if a==True then 1 else 0

tupleconvert (a,b,c,d) = (booleanconvert a, booleanconvert b, booleanconvert c, booleanconvert d)

display j c k = foldl (\x (p,q,r,s) -> x++[tupleconvert (p,q,r,s)]) [] (take 100 (jkflipflop j c k))

display1 j c k = foldl (\x (p,q,r,s) -> x++[tupleconvert (p,q,r,s)]) [] (take 100 (jkflipflop1 j c k))