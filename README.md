## Komen Spelen: Battle of Bands

This backbone web-app serves the purpose of organising bandbattle events, where bands of any genre take on other bands in a series of gigs. Per gig, one band plays and the others rate them according to set quota such as the overall experience or things like instrument expertise.

### API Cheatsheet

##### Bands & Bandmembers: Getters
- /api/bands/
- /api/bands/:id/
- /api/bands/:id/members/
- /api/bandmembers/:id/

##### Bands & Bandmembers: Validation
- /api/validate/banddata/

##### Bands & Bandmembers: Setters
- /api/bands/bands/ 				(add band: post)
- /api/bands/bands/:id/members/ 	(add bandmember: post)
- /api/bands/:id/ 					(edit band: put)
- /api/bands/:id/ 					(delete band: delete)

##### Bandbattles: Getters
- /api/bandbattles/
- /api/bandbattles/:id/
- /api/bandbattles/:id/events/
- /api/bandbattlegigs/:id/ 			(specific bandbattle event)

##### Bandbattles: Invites
- /api/bandbattles/invites/checkcode/:code/ 		(validate invitation code)
- /api/bandbattles/:id/invites/sendcode/ 			(send invite code via mail)
- /bandbattles/invites/:id/ 						(delete: remove invite code)

##### Bandbattles: Setters
- /api/bandbattles/ 					(add bandbattle: post)
- /api/bandbattles/:id/events/ 			(add gig to bandbattle: post)
- /api/bandbattles/:id/ 				(edit bandbattle: put)
- /api/bandbattles/:id/ 				(remove bandbattle: delete)

##### Ratings: Getters
- /api/ratings/
- /api/ratings/for/:band_id/
- /api/ratings/by/:band_id/
- /api/ratings/:id/
- /api/ratings/quota/options/ 			(grading quota)
- /api/ratings/quota/options/:id 		(specific quota)

##### Ratings: Validation
- /api/validation/ratingData/ 					(post)
- /api/validation/ratingData/scoreUpdate/ 		(post)

##### Ratings: Setters
- /api/ratings/for/:band_id/ 		(add rating for band: post)
- /api/ratings/:id/ 				(edit rating: put)
- /api/ratings/:id/ 				(remove rating: delete)

##### Images: Getters
- /api/images/
- /api/images/:id/
- /api/bandbattle/:bandbattle_id/images/

##### Images: Setters
- /api/images/ 						(add image: post)
- /api/images/:id/ 					(remove image: delete)

