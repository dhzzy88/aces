from aces.materials.POSCAR import structure as Material
class structure(Material):
	def getPOSCAR(self):
		return """Sn4 Se4
1.0
6.417233 0.000000 0.000000
0.000000 6.417233 0.000000
0.000000 0.000000 6.417233
Sn Se
4 4
direct
0.000000 0.000000 0.000000 
0.000000 0.500000 0.500000 
0.500000 0.000000 0.500000 
0.500000 0.500000 0.000000 
0.000000 0.500000 0.000000 
0.000000 0.000000 0.500000 
0.500000 0.500000 0.500000 
0.500000 0.000000 0.000000 
"""
			
		